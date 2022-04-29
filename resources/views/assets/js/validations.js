import {extend} from 'vee-validate';
import {confirmed, email, is_not, max, min, required} from 'vee-validate/dist/rules';

extend('required', {
  ...required,
  message: 'Dit veld is verplicht.',
});

extend('min', {
  ...min,
  params: ['length'],
  message: 'Deze waarde mag niet korter zijn dan {length} karakters.',
});

extend('minValue', {
  validate: (value, params) => isNaN(value) ? false : (Number(value) >= params.min),
  params: ['min'],
  message: 'Deze waarde moet minimaal {min} zijn.',
});

extend('max', {
  ...max,
  params: ['length'],
  message: 'Deze waarde mag niet langer zijn dan {length} karakters.',
});

extend('maxValue', {
  validate: (value, params) => isNaN(value) ? false : (Number(value) <= params.max),
  params: ['max'],
  message: 'Deze waarde mag maximaal {max} zijn.',
});

extend('email', {
  ...email,
  message: 'Voer een geldig e-mailadres in.',
});

extend('confirmed', {
  ...confirmed,
  message: 'De {target} velden komen niet overeen.',
});

extend('distinct', {
  validate: (value, args) => value !== args.target,
  params: ['target'],
  message: 'De velden {target} en {_field_} moeten verschillend zijn.',
});

extend('is_not', {
  ...is_not,
  message: 'Waarde mag niet gelijk zijn aan {other}.',
});

extend('before', {
  validate: (value, args) => new Date(value) < new Date(args.date),
  params: ['date'],
  message: 'Kies een datum voor {date}.',
});

extend('after', {
  validate: (value, args) => new Date(value) > new Date(args.date),
  params: ['date'],
  message: (fieldName, placeholders) => `Kies een datum na ${new Date(placeholders.date).toLocaleDateString('nl-NL')}.`,
});

extend('regex', {
  validate: (value, params) => new RegExp(params.exp).test(value),
  params: ['exp'],
  message: 'Het formaat van het {_field_} veld is niet geldig.',
});
