denkmal.org [![Build Status](https://travis-ci.org/denkmal/denkmal.org.png)](https://travis-ci.org/denkmal/denkmal.org)
===========

[![Join the chat at https://gitter.im/denkmal/denkmal.org](https://badges.gitter.im/denkmal/denkmal.org.svg)](https://gitter.im/denkmal/denkmal.org?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

Development
-----------
Install the [librarian-puppet](https://github.com/mhahn/vagrant-librarian-puppet)
and [landrush](https://github.com/phinze/landrush) plugins for Vagrant:
```
vagrant plugin install vagrant-librarian-puppet
vagrant plugin install landrush
```

Start and provision the box:
```
vagrant up
```

The website should now be accessible on your host machine at https://denkmal.dev.cargomedia.ch.
The admin interface runs on https://admin-denkmal.dev.cargomedia.ch (login: `admin` / `admin`).
