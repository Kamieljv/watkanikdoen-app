export interface Actie {
  id: number;
  title: string;
  body: string;
  date: string;
  themes: Theme[];
  categories: Category[];
  url: string;
  location: {
    type: string;
    coordinates: [number, number];
  };
  distance?: number | null;
}

export interface Theme {
  id: number;
  name: string;
  color: string;
}

export interface Category {
  id: number;
  name: string;
  color: string;
}

export interface Organizer {
  id: number;
  name: string;
}

export interface Notification {
  id: number;
  data: {
    title: string;
    body: string;
    link: string;
  };
  created_at: Date;
  read_at: Date | null;
  unread: boolean;
}

export interface Report {
  id: number;
  title: string;
  description: string;
  date: string;
  location: {
    type: string;
    coordinates: [number, number];
  };
  organizers: Organizer[];
}

export interface Question {
  id: number;
  subject: string;
  question: string;
  description: string;
  answers: Answer[];
}

export interface Answer {
  id: number;
  answer: string;
  dimensions: {
    name: string;
    pivot: {
      score: number;
    };
  }[];
}

export interface Dimension {
  name: string;
  maxScore?: number;
}

export interface Tag {
  id: number;
  name: string;
}

export interface Book {
  id: number;
  title: string;
  description: string;
  author: string;
  year: number;
  publisher: string;
  isbn: string;
  cover_image: string;
  themes: Theme[];
  tag_names: string[];
  book_shelves: {
    slug: string;
    organizer: {
      name: string;
      image_url: string;
    };
  }[];
}

export interface BookShelf {
  id: number;
  title: string;
  description: string;
  books: BookShelfBook[];
}

export interface BookShelfBook extends Book {
  notes: string;
}
