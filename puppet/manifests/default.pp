node default {

  $domain = 'denkmal.dev'

  include 'cm::services'

  class {'cm::application':
    development => true,
  }

  cm::vhost {"www.${domain}":
    path => '/vagrant',
    debug => true,
    aliases => [$domain, "admin.${domain}"],
    cdn_origin => "origin-www.${domain}",
  }

  environment::variable {'PHP_IDE_CONFIG':
    value => 'serverName=vagrant',
  }

}
