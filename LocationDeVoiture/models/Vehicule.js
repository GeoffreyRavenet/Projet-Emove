var mongoose = require('mongoose');

var vehiculeSchema = new mongoose.Schema({
    name: String,
    NbRoue: Number,
    description:String,
    picture: String,
    marques: [
        {
            type: mongoose.Schema.Types.ObjectId,
            ref:'Marque'
        }
    ]
});

var Vehicule = mongoose.model('Vehicule' , vehiculeSchema);

module.exports = Vehicule;