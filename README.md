denkmal.org [![Build Status](https://travis-ci.org/denkmal/denkmal.org.png)](https://travis-ci.org/denkmal/denkmal.org)
===========

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

Fill in some example data:
```
vagrant ssh -c 'denkmal/bin/cm app fill-example-data'
```

Create elasticsearch indices:
```
vagrant ssh -c 'denkmal/bin/cm search-index create'
```

The app should now be accessible on your host machine at http://www.denkmal.dev/!
