# Project Stack

This Project uses the following libraries and versions:

- Craft CMS: 4
- Tailwind CSS: 3
- Alpine JS: 3
- Vite: 4

Platform requirments:

- PHP: 8.2
- Node: 18
- PostgreSQL: 14
- Redis: 7

Local development requirements:

- [ddev](https://ddev.readthedocs.io/en/stable/#macos-homebrew)
- [tableplus](https://formulae.brew.sh/cask/tableplus)

## Features

- Navigation builder
- SEO ready
- Local dev preconfigured
  - ddev for all platform requirements and ssl
  - extra container commands preconfigured
  - vscode plugins for debugging and intellisense
- Build process preconfigured
  - js bundling and minification
  - css bundling and minification
  - manifest for cache invalidation
  - subresource integrity
- VSCode integration preconfigured
  - Extensions
  - Syntax highlighting
  - Static errors
- Quality Assurance
  - (Auto) Formatting
  - Linting
  - Typechecking
- Easy favicon setup
- Absolute imports from src directory

### Creating New Project

When starting a new project, first update dependencies on boilerplate. This will ensure boilerplate is kept up to date while making this batch of updates simpler for the current site.

- `git clone git@github.com:acalvino4/craft-boilerplate.git`
- `git checkout -b update-m-y`
- `ddev update` for automatic updates
- `ddev composer outdated` && `ddev npm outdated` to check for manual updates
- perform manual updates
- check for php, node, redis, and postgres LTS updates, and perform if availible and compatible (updating this README and the ddev config)
- run tests
- push and merge

Now you can create a new repo.

- Fork repo on github, then clone to local.
- Replace all instances of `boilerplate` with the project name
  - `package.json`
  - `.env.example`
  - `.ddev/config.yaml`
  - `.vscode/launch.json`
  - throughout `config/project` directory
- Update `cpTrigger` in `config/general.php` to something interesting/appropriate for project
- Update `email.fromEmail` in `config/project/project.yaml` to the appropriate email that should send system email
- Follow favicon instructions at bottom of this doc
- Delete this "Creating New Project" section
- Commit and push

## Local Setup

- `git clone git@github.com:acalvino4/<site-name>.git`
- `cd <site-name>`
- `ddev setup`
- Download database backup from staging or production, and import with command below

## Development

### Commands

- Start / stop app: `ddev start` / `ddev stop`
- Start / stop dev server: `ddev dev` / `^c`
- Start / stop xdebug: `ddev xdebug on` + `F5` / `ddev xdebug off`
- Enable Craft debug toolbar: From Craft control panel, user icon in top right > Preferences > Development. Debug toolbar is then accesible through icon in bottom right.
- Open database in TablePlus: `ddev tableplus`
- Export database: `ddev export-db -f=/tmp/dump.sql.gz`
- Import database: `ddev import-db --src=/tmp/dump.sql.gz`
- Launch mailhog window: `ddev launch -m`
- Manually build assets: `ddev build`
- Update all dependencies: `ddev update`
- Check formatting, linting, and type safety in ts and php: `ddev test`
- Fix auto-fixable problems: `ddev fix`

- `composer`, `npm`, and `craft` commands MUST be run from the ddev container - just preface them with `ddev`

### Typescript

This project is configured to use [`alpine.js`](https://alpinejs.dev/). Before implementing any custom behavior, see if alpine can handle your needs using template directives, and also checkout [headless](https://alpinejs.dev/components#headless), [integrations](https://alpinejs.dev/components#integrations), and [components](https://alpinejs.dev/components#components), in that priority order to see if they can fill your needs.

Typescript is configured for absolute imports from the `css` and `ts` directories. To setup absolute imports for any other directories you may add, follow the format in the `compilerOptions.paths` setting of `tsconfig.json` and the `resolver.alias` setting of `vite.config.ts`, or reference [this guide](https://dev.to/tariky/absolute-imports-vite-typescript-2022-32am).

### CSS

This project is setup to use [tailwindcss](https://tailwindcss.com/), so you should always use utility classes over writing css if possible.

### Favicons

All you need to do is drop a few specific files into the `src/favicon` directory. The build process and templates will take care of the rest. See [this guide](https://evilmartians.com/chronicles/how-to-favicon-in-2021-six-files-that-fit-most-needs) for details on creating various icons formats (an svg should always be the master image from which all others are generated).

- `favicon.ico`, a 32x32 image in ico format
- `favicon.svg`, an svg configured for both light and dark contexts
- `favicon-180.png`, a 180x180 png for apple touch icon, preferably with a background color and 20px of padding
- `favicon-192.png`, a 192x192 png for andorid home screen links
- `favicon-512.png`, a 512x512 png for android splash screens

### Upstream updates

If a website's needs would apply to the majority of webstites, make them on the [boilerplate repo](https://github.com/acalvino4/craft-boilerplate) and then merge them into your site. This way, we can take advantage of your improvement for all our sites. To merge changes from the boilerplate into your site:

- `git remote add boilerplate git@github.com:acalvino4/craft-boilerplate.git` (only needs to be done once)
- checkout new branch
- `git fetch boilerplate`
- `git merge boilerplate/master`
- deal with any merge conflicts and commit
