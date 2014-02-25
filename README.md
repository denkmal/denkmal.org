denkmal.org [![Build Status](https://travis-ci.org/denkmal/denkmal.org.png)](https://travis-ci.org/denkmal/denkmal.org)
===========

Development
-----------
Install the [`librarian-puppet` plugin for vagrant](https://github.com/mhahn/vagrant-librarian-puppet):
```
vagrant plugin install vagrant-librarian-puppet
```

Install the [DNS plugin for vagrant](https://github.com/BerlinVagrant/vagrant-dns) and register it in OSX:
**This plugin is [currently broken with vagrant 1.4.3](https://github.com/BerlinVagrant/vagrant-dns/issues/27). It is recommended to use `/etc/hosts` instead.**
```
vagrant plugin install vagrant-dns
vagrant dns --install
```

Start and provision the box:
```
vagrant up
```

Create elasticsearch indices:
```
vagrant ssh -c 'denkmal/bin/cm search-index create'
```

Fill in some example data:
```
vagrant ssh -c 'denkmal/bin/cm app fill-example-data'
```
