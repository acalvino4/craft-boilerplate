#!/usr/bin/env zsh

read "vendor_name?What is your vendor name (i.e. your github handle): "
read "project_name?Enter the name of your project (suggested you make this your site's domain without www. or .com): "

# replace "boilerplate" with project_name where possible, and "acalvino4" with vendor name
# need to discern where to change and where not to; not as simple as global find/replace

git init
git add -A
git commit -a -m "initial project scaffolding"

ddev setup

cat <<EOS
Your new project is fully bootstrapped and can be accessed at https://$project_name.local
Just a few things remain to really personalize it to your needs:
- Delete or modify LICENSE.md as appropriate for your project
- Update cpTrigger in config/general.php to something interesting/appropriate for your project
- Update email.fromEmail in config/project/project.yaml to the appropriate email that should send system email
- Check out README.md for how to configure and use fonts, favicons, css, and js in this project.
- Create a remote repo in your chosen repository management system (i.e. github/bitbucket), and push project there.
EOS
