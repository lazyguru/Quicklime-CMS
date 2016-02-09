# Quicklime TODO list

## Priority

* Change `cms/` directory structure so that language is top level and menus, pages and messages are sub-directories of it.
* Make a decision about Twitter Bootstrap: it is currently used by the Quick16 theme and should not be included in Quicklime. Or it should.
* Write a custom Bootstrap Generator: configure menus and other objects with files (yaml, json, php), including a universal language selector

## Long term

* Pack Quicklime in its own package, so that the App namespace is free to use for user
* Front matter in `.md` files
* Use Minifiers
* Add drafts functionnality
* Use package manager for themes (Composer ?)
* Add more elements in the sidebar, not only a toc or a menu (use Front Matter for per page display)

## Configuration features

* Add redirections functionnality: store routes redirections in a separate file
* Make page size adjustement configurable: if there is a toc, use full page width or not.
* Add configuration option: try_section. If false, do not try `url/` if `url` does not exist

## Others

Propose your own features! Fork and:
* edit this file to add your ideas
* add your ideas directly and make a pull request!
