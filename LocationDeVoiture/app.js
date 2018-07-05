var express = require('express');
var mongoose = require('mongoose');
var nunjucks = require('nunjucks');

mongoose.connect('mongodb://localhost/LocationDeVoiture');

require('./models/Vehicule');
require('./models/Marque');

var app = express();


app.use('/css', express.static(__dirname + '/node_modules/bootstrap/dist/css'));

app.use('/', require('./routes/vehicules'));
app.use('/marques', require('./routes/marques'));

nunjucks.configure('views' , {
        autoescape: true,
        express: app
});


console.log('Site lancé sur le port 3000');
app.listen(3000);
