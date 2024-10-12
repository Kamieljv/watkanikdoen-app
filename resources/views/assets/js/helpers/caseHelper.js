export const sentenceCase = str => str.charAt(0).toUpperCase() + str.slice(1)

export const titleCase = str => str.split(' ').map(word => sentenceCase(word)).join(' ')

export const upperCase = str => str.toUpperCase()

export const lowerCase = str => str.toLowerCase()

export const capitalize = str => str.charAt(0).toUpperCase() + str.slice(1)

export const kebabCase = str => str.replace(/([a-z])([A-Z])/g, '$1-$2').replace(/\s+/g, '-').toLowerCase()

export const snakeCase = str => str.replace(/([a-z])([A-Z])/g, '$1_$2').replace(/\s+/g, '_').toLowerCase()

export const camelCase = str => str.replace(/-([a-z])/g, g => g[1].toUpperCase()).replace(/_([a-z])/g, g => g[1].toUpperCase())

export const pascalCase = str => str.replace(/(\w)(\w*)/g, (g0, g1, g2) => g1.toUpperCase() + g2.toLowerCase()).replace(/-|_/g, '')
