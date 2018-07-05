var mongoose = require('mongoose');

var typeSchema = new mongoose.Schema({
    name:String,
    picture: String
});

typeSchema.virtual('vehicule',{
    ref:'Vehicule',
    localField: '_id',
    foreignField: 'types'
});

var Type = mongoose.model('Type', typeSchema);

module.exports = Type;
//type.pokemons