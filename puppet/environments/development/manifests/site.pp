node default {

  class { 'cm::application':
    development => true,
  }

  class { 'cm::services':
    ssl_key  => template('denkmal/ssl/*.dev.cargomedia.ch.key'),
    ssl_cert => template('denkmal/ssl/*.dev.cargomedia.ch.pem'),
  }

  Cm::Vhost {
    path     => '/home/vagrant/denkmal',
    debug    => true,
    ssl_key  => template('denkmal/ssl/*.dev.cargomedia.ch.key'),
    ssl_cert => template('denkmal/ssl/*.dev.cargomedia.ch.pem'),
  }

  cm::vhost { 'denkmal.dev.cargomedia.ch':
    cdn_origin => 'origin-denkmal.dev.cargomedia.ch',
  }
  cm::vhost { 'admin-denkmal.dev.cargomedia.ch': }

  environment::variable { 'PHP_IDE_CONFIG':
    value => 'serverName=www.denkmal.dev',
  }

}
