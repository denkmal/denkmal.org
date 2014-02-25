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

Install the [PhpStorm tunnel plugin for vagrant](https://github.com/cargomedia/vagrant-phpstorm-tunnel):
```
vagrant plugin install vagrant-phpstorm-tunnel
```

Start and provision the box:
```
vagrant up
```

AWS Deployment
--------------
Install the [AWS provider for vagrant](https://github.com/mitchellh/vagrant-aws):
```
vagrant plugin install vagrant-aws
```
