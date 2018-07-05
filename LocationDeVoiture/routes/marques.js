var router = require('express').Router();

var Marque = require('./../models/Marque')

/*router.get("/:marque" , (req,res) =>{
    Type.findOne({name: req.params.type}).populate("vehicules").then(type =>{
        if(!type) return res.status(404).send('Type introuvable');
        res.render('marques/show.html',{
            type: type,
            marques: type.pokemons
        })  
    });
});*/

module.exports = router;