import { defineRule, configure } from 'vee-validate';
import { confirmed, email, is_not, url, max, min, required } from '@vee-validate/rules';
import { localize } from '@vee-validate/i18n';

// Define the rule globally
defineRule('required', required)
defineRule('min', min)
defineRule('max', max)
defineRule('email', email)
defineRule('confirmed', confirmed)
defineRule('is_not', is_not)
defineRule('url', url)


configure({
  // Generates an English message locale generator
  generateMessage: localize('nl', {
    messages: {
      required: 'Dit veld is verplicht',
      min: 'Deze waarde mag niet korter zijn dan 0:{min} karakters.',
      max: 'Deze waarde mag niet langer zijn dan 0:{max} karakters.',
      email: 'Voer een geldig e-mailadres in.',
      confirmed: 'De {target} velden komen niet overeen.',
      is_not: 'Waarde mag niet gelijk zijn aan {other}.',
      url: 'Voer een geldige URL in.'
    },
  }),
});

// defineRule('before', {
//   validate: (value, { otherValue} ) => new Date(value) < new Date(otherValue),
//   params: ['date'],
//   message: 'Kies een datum voor {date}.',
// }, {
//   hasTarget: true
// });

// defineRule('after', {
//   params: ['target'],
//   validate: (value, {target}) => new Date(value) > new Date(target),
//   message: 'Kies een datum na {target}.',
// }, {
//   hasTarget: true
// });

// defineRule('afterIncluding', {
//   params: ['target'],
//   validate: (value, {target}) => new Date(value) >= new Date(target),
//   message: 'Kies een datum vanaf {target}.',
// }, {
//   hasTarget: true
// });

// defineRule('afterToday', {
//   validate: (value) => new Date(value) > new Date(),
//   message: 'Kies een datum na vandaag.',
// });

// defineRule('regex', {
//   validate: (value, params) => new RegExp(params.exp).test(value),
//   params: ['exp'],
//   message: 'Het formaat van het {_field_} veld is niet geldig.',
// });

// defineRule('url', {
//   validate(value) {
//     var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
//       '(([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}' + // domain name
//       '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
//       '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
//       '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
//     return pattern.test(value);
//   },
//   message: 'Vul een geldige URL in.'
// });
