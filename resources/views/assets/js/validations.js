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
  validate: (value, { otherValue} ) => new Date(value) < new Date(otherValue),
  params: ['date'],
  message: 'Kies een datum voor {date}.',
}, {
  hasTarget: true
});

extend('after', {
  params: ['target'],
  validate: (value, {target}) => new Date(value) > new Date(target),
  message: 'Kies een datum na {target}.',
}, {
  hasTarget: true
});

extend('afterIncluding', {
  params: ['target'],
  validate: (value, {target}) => new Date(value) >= new Date(target),
  message: 'Kies een datum vanaf {target}.',
}, {
  hasTarget: true
});

extend('afterToday', {
  validate: (value) => new Date(value) > new Date(),
  message: 'Kies een datum na vandaag.',
});

extend('regex', {
  validate: (value, params) => new RegExp(params.exp).test(value),
  params: ['exp'],
  message: 'Het formaat van het {_field_} veld is niet geldig.',
});

extend('url', {
  validate(value) {
    var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
      '(([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}' + // domain name
      '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
      '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
      '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
    return pattern.test(value);
  },
  message: 'Vul een geldige URL in.'
});
