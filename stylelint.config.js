module.exports = {
    extends: [
        "stylelint-config-standard-scss",
    ],
    rules: {
        'at-rule-empty-line-before': [
          'always', {
            except: ['blockless-after-blockless', 'blockless-after-same-name-blockless', 'first-nested'],
            ignore: ['after-comment', 'inside-block'],
            ignoreAtRules: ['apply', 'screen', 'font-face', 'nest'],
          },
        ],
        'scss/at-rule-no-unknown': [
          true, {
            ignoreAtRules: ['tailwind', 'variants', 'responsive', 'apply', 'layer', 'screen'],
          },
        ],
        'property-no-unknown': [
          true, {
            ignoreProperties: ['font-path']
          },
        ],
        'selector-nested-pattern': '^&',
    }
}