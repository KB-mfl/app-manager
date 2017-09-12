module.exports = {
  port: 4400, // local port for webpack-server
  api: { // api proxy
    host: 'http://192.168.1.108:8000', // api host
    prefix: '/api/'
  }
}
