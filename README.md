denkmal.org
===========

Denkmal.org is an Oi!-project and aims to serve as an alternative event calendar for your city.

[![Build Status](https://img.shields.io/travis/denkmal/denkmal.org/master.svg)](https://travis-ci.org/denkmal/denkmal.org)
[![Gitter Chat](https://img.shields.io/gitter/room/denkmal/denkmal.org.svg)](https://gitter.im/denkmal/denkmal.org)

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
