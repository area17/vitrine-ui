import path from 'node:path'
import { fileURLToPath } from 'node:url'

import { includeIgnoreFile } from '@eslint/compat'
import js from '@eslint/js'
import eslintConfigPrettier from 'eslint-config-prettier'
import simpleImportSort from 'eslint-plugin-simple-import-sort'
import unusedImports from 'eslint-plugin-unused-imports'
import globals from 'globals'

const __filename = fileURLToPath(import.meta.url)
const __dirname = path.dirname(__filename)
const gitignorePath = path.resolve(__dirname, '.gitignore')

export default [
    includeIgnoreFile(gitignorePath),
    js.configs.recommended,
    eslintConfigPrettier,
    {
        name: 'default',
        files: ['**/*.js', '**/*.jsx', '**/*.mjs', '**/*.cjs'],
        plugins: {
            'unused-imports': unusedImports,
            'simple-import-sort': simpleImportSort
        },
        rules: {
            'no-unused-vars': 'off',
            'unused-imports/no-unused-imports': 'error',
            'unused-imports/no-unused-vars': [
                'warn',
                {
                    vars: 'all',
                    varsIgnorePattern: '^_',
                    args: 'after-used',
                    argsIgnorePattern: '^_'
                }
            ],
            'simple-import-sort/imports': 'error',
            'simple-import-sort/exports': 'error'
        },
        languageOptions: {
            ecmaVersion: 'latest',
            globals: {
                ...globals.browser,
                ...globals.node,
                A17: true
            }
        }
    }
]
