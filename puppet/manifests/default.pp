node default {

  $domain = "denkmal.dev"

  include 'cm::services'

  cm::application{'denkmal.org':
    path => '/vagrant',
    web => true,
    debug => true,
    development => true,
    vhosts => {
      "www.${domain}" => {
        aliases => [$domain, "admin.${domain}"],
        cdn_origin => "origin-www.${domain}",
      }
    },
  }

}
