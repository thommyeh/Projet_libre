var config = {
  type: Phaser.AUTO,
  width: 800,
  height: 600,
  scene: {
    preload: preload,
    create: create,
    update: update
  }
};

var game = new Phaser.Game(config);

var body;
var face;
var outfit;
var hair;
var item;

function preload() {

  //UI
  this.load.image('background', './img/UI/background.png');
  this.load.image('bottomMenu', './img/UI/BottomMenu.png');
  this.load.image('leftMenu', './img/UI/SideMenu.png');
  this.load.image('Canvas', './img/UI/Canvas.png');

  //Body parts
  this.load.image('Body', './img/body/BodyMale.png');
  this.load.image('Face', './img/face/Face.png');
  this.load.image('Outfit', './img/outfit/Outfit.png');
  this.load.image('Hair', './img/hair/Hair.png');
  this.load.image('Item', './img/items/Item.png');

  //Body
  this.load.image('BodyMale', './img/body/BodyMale.png');
  this.load.image('BodyFemale', './img/body/BodyFemale.png');
  this.load.image('BodyElf', './img/body/BodyElf.png');

  //Face
  this.load.image('FaceOld', './img/face/FaceOld.png');
  this.load.image('FaceOlder', './img/face/FaceOlder.png');

  //Outfit
  this.load.image('OutfitMage', './img/outfit/OutfitMage.png');
  this.load.image('OutfitCloth', './img/outfit/OutfitCloth.png');

  //Hair
  this.load.image('HairBlond', './img/hair/HairBlond.png');
  this.load.image('HairSilver', './img/hair/HairSilver.png');

  //Items
  this.load.image('ItemHorns', './img/items/ItemHorns.png');
  this.load.image('ItemMask', './img/items/ItemMask.png');
}

function create() {

  //UI
  this.add.sprite(400, 300, 'background');
  this.add.sprite(400, 600, 'bottomMenu');
  this.add.sprite(120, 220, 'leftMenu');

  //Body Menu
  bodyMaleButton = this.add.sprite(60, 50, 'BodyMale').setInteractive();
  bodyFemaleButton = this.add.sprite(120, 50, 'BodyFemale').setInteractive();
  bodyElfButton = this.add.sprite(180, 50, 'BodyElf').setInteractive();

  //Face Menu
  faceButton = this.add.sprite(60, 150, 'Face').setInteractive();
  faceOldButton = this.add.sprite(120, 150, 'FaceOld').setInteractive();
  faceOlderButton = this.add.sprite(180, 150, 'FaceOlder').setInteractive();

  //Outfit Menu
  outfitButton = this.add.sprite(60, 220, 'Outfit').setInteractive();
  outfitMageButton = this.add.sprite(120, 220, 'OutfitMage').setInteractive();
  outfitClothButton = this.add.sprite(180, 220, 'OutfitCloth').setInteractive();

  //Hair Menu
  hairButton = this.add.sprite(60, 320, 'Hair').setInteractive();
  hairBlondButton = this.add.sprite(120, 320, 'HairBlond').setInteractive();
  hairSilverButton = this.add.sprite(180, 320, 'HairSilver').setInteractive();

  //Item Menu
  itemButton = this.add.sprite(60, 420, 'Item').setInteractive();
  itemHornsButton = this.add.sprite(120, 420, 'ItemHorns').setInteractive();
  itemMaskButton = this.add.sprite(180, 420, 'ItemMask').setInteractive();

  //Paperdoll
  body = this.add.sprite(400, 300, 'Canvas');
  outfit = this.add.sprite(400, 300, 'Canvas');
  face = this.add.sprite(400, 300, 'Canvas');
  hair = this.add.sprite(400, 300, 'Canvas');
  item = this.add.sprite(400, 300, 'Canvas');

  //Buttons Input

  //Body Select
  bodyMaleButton.on('pointerdown', function(pointer, x, y) {
    body.setTexture('BodyMale');
  }, this);

  bodyFemaleButton.on('pointerdown', function(pointer, x, y) {
    body.setTexture('BodyFemale');
  }, this);

  bodyElfButton.on('pointerdown', function(pointer, x, y) {
    body.setTexture('BodyElf');
  }, this);

  //Face Select
  faceButton.on('pointerdown', function(pointer, x, y) {
    face.setTexture('Face');
  }, this);

  faceOldButton.on('pointerdown', function(pointer, x, y) {
    face.setTexture('FaceOld');
  }, this);

  faceOlderButton.on('pointerdown', function(pointer, x, y) {
    face.setTexture('FaceOlder');
  }, this);

  //Outfit Select
  outfitButton.on('pointerdown', function(pointer, x, y) {
    outfit.setTexture('Outfit');
  }, this);

  outfitMageButton.on('pointerdown', function(pointer, x, y) {
    outfit.setTexture('OutfitMage');
  }, this);

  outfitClothButton.on('pointerdown', function(pointer, x, y) {
    outfit.setTexture('OutfitCloth');
  }, this);

  //Hair Select
  hairButton.on('pointerdown', function(pointer, x, y) {
    hair.setTexture('Hair');
  }, this);

  hairBlondButton.on('pointerdown', function(pointer, x, y) {
    hair.setTexture('HairBlond');
  }, this);

  hairSilverButton.on('pointerdown', function(pointer, x, y) {
    hair.setTexture('HairSilver');
  }, this);

  //Item Select
  itemButton.on('pointerdown', function(pointer, x, y) {
    item.setTexture('Item');
  }, this);

  itemHornsButton.on('pointerdown', function(pointer, x, y) {
    item.setTexture('ItemHorns');
  }, this);

  itemMaskButton.on('pointerdown', function(pointer, x, y) {
    item.setTexture('ItemMask');
  }, this);
}

function update() {}