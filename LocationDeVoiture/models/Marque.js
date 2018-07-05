var mongoose = require('mongoose');

var marqueSchema = new mongoose.Schema({
    name: String, 
    picture: String
});

marqueSchema.virtual('vehicules', {
    ref:'Vehicule' , 
    localField: '_id',
    foreignField: 'marques'
});

var Marque = mongoose.model('Marque' , marqueSchema);
module.exports = Marque;