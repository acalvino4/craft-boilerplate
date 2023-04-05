# Contributing

## Updates

General updates are best done whenever creating a new project since that new project had best start out on the right foot with the latest versions, and doing such kills two birds with one stone.

- `git clone https://github.com/acalvino4/craft-boilerplate.git`
- `git checkout -b update-mm-yyyy`
- `ddev update` for automatic updates
- `ddev composer outdated` && `ddev npm outdated` to check for manual updates
- perform manual updates
- check for php, node, redis, and postgres LTS updates, and perform if availible and compatible (updating this README and the ddev config)
- `ddev test`
- push and merge

## Todo

- svg build process?
- CKEditor/Vizy setup
- refactor to use create-project
- db backup in new project bootstrap process?
- GDPR compliance
- Image transforms
- github actions deployment file
  - Composer deps for pipeline builds
  - Implement caching in pipeline
- come up with a good 'children' construct (as in jsx) for twig - [github discussion](https://github.com/craftcms/cms/discussions/12671)
- consider other less restrictive licenses that don't require license to be included in derivative works

Server deployment process
https://observatory.mozilla.org/
