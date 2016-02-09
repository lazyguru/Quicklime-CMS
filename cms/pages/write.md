# Write

## Write some content

Pages you publish are stored in `cms/pages/` directory. Just create as many `.md` files as you want. You may create sub-directories, which will be sub-directories in the URL too.

Quicklime uses [CommonMark](http://commonmark.thephpleague.com/) package for Laravel. Your pages should therefore respect the [CommonMark specifications](http://spec.commonmark.org/).

## Static files (images, etc.)

You can store static files in `cms/static/` directory. You may store them anywhere else if you like. This pre-existing directory is just for convenience. Do what you like, this website is yours!

If you want to use custom CSS or some JS, you currently have to manually add them to the main template, which is `cms/themes/XXXXXX/html/master.blade.php`.  
The template is written with [Blade](https://laravel.com/docs/5.2/blade) which is very easy to learn and use. It's mostly HTML with some specific functions for conditions, loops, etc.

## Versionning with git

Quicklime is designed to allow you publish your content with git. You may use any other VCS or none at all and publish via FTP.

If you have Git 2.3 or more recent, you can configure it to receive push directly. Otherwise, you will have to use a bare directory (of your own, or hosted at Github or equivalent).

### Remote repository

#### Git 2.3+

If you have Git2.3 or more recent on your server, you can push directly to a working repository. Initialize a new repo:

```shell
git init
```

Set the configuration to allow this repo to receive pushes:

```shell
git config receive.denyCurrentBranch updateInstead
```

#### Git < 2.3

You need to use a bare repository to push to it. You will have to pull changes from the website repository.

Initialize a new bare repository:

```shell
git init --bare
```

If you want to, you can use a public repository like Github, Gitbook, etc. They use bare repositories, so you just have to follow the instructions they provide.

### Local repository

A git repository has already been initialized in `cms/` directory with the Quicklime default contents (which you are currently reading). If you want to reset it, just delete `cms/.git/` directory and initialize a new repository:

```shell
cd cms
git init
```

Add the remote repository to your local repo:

```shell
git remote add published xxxxxxxxxxxx
```

where `published` is the name you want to give to this remote repository, and `xxxxxxxxxxxx` the URL to your remote repository.

Write the pages you want, add them, commit and push to publish:

```shell
git add .
git commit
git push published
```
### Website repository

If you use a bare repository, you have to pull the data from it to your website repo.
Initialize a repository on your webserver, add the remote repository just like you did for your local repo and pull:

```shell
git pull published
```
