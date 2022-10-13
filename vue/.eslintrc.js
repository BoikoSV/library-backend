module.exports = {
  root: true,
  env: {
    browser: true,
    node: true
  },
  parserOptions: {
    parser: '@babel/eslint-parser',
    requireConfigFile: false
  },
  extends: [
    '@nuxtjs',
    'plugin:nuxt/recommended'
  ],
  ignorePatterns: ["plugins/cselect.js"],
  rules: {
    'vue/html-indent': 0,
    'vue/singleline-html-element-content-newline': 0,
    'vue/component-name-in-template-casing': ['error', 'PascalCase'],
    'vue/valid-v-slot': [
      'error',
      {
        allowModifiers: true
      }
    ],
    semi: 0,
    quotes: [2, 'single', { avoidEscape: true }]
  },
  globals: {
    _: true
  }
}
