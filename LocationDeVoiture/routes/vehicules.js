var router = require('express').Router();

var Vehicule = require('./../models/Vehicule');
var Marque = require('./../models/Marque');

router.get('/',(req, res) => {
    Vehicule.find({}).populate('marques').then(vehicules =>{
        res.render('vehicules/index.html', {vehicules: vehicules});
    })
})
router.get('/new', (req, res) => {
    Marque.find({}).then(marques => {
        var vehicule = new Vehicule();
        res.render('vehicules/edit.html', {vehicule: vehicule , marques: marques});
    })
   
})
router.get('/edit/:id', (req , res) => {
    Marque.find({}).then(marques =>{
        Vehicule.findById(req.params.id).then(vehicule =>{
            res.render('vehicules/edit.html', {vehicule: vehicule, marques: marques}); 
        }),
        err => res.status(500).send(err);
    })
   
});
router.get('/:id' , (req, res) => {
    Vehicule.findById(req.params.id).populate('marques').then(vehicule =>{
        res.render('vehicules/show.html', {vehicule: vehicule});  
    }),
    err => res.status(500).send(err);
})
module.exports = router;