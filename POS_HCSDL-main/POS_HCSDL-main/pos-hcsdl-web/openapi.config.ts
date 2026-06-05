import { defineConfig } from '@luannguyen23081996/open-api-gen';

export default defineConfig({
  api: [
    {
      name: 'pos',
      input: 'http://localhost:9001/v3/api-docs',
      prefixUrl: '',
      zod: {},
    },
  ],
  outDir: './src/api',
  generator: 'openapi',
});
