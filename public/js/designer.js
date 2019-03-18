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
  this.load.image('bodyButton', './img/UI/BodyButton.png');
  this.load.image('faceButton', './img/UI/FaceButton.png');
  this.load.image('outfitButton', './img/UI/OutfitButton.png');
  this.load.image('hairButton', './img/UI/HairButton.png');
  this.load.image('itemButton', './img/UI/ItemsButton.png');

  //Buttons
  this.load.image('BodyMaleButton', './img/UI/BodyMaleButton.png');
  this.load.image('BodyFemaleButton', './img/UI/BodyFemaleButton.png');

  //Body parts
  this.load.image('Body', './img/body/BodyMale.png');
  this.load.image('Face', './img/face/Face.png');
  this.load.image('Outfit', './img/outfit/Outfit.png');
  this.load.image('Hair', './img/hair/Hair.png');
  this.load.image('Item', './img/items/Item.png');

  //Body
  this.load.image('BodyMale', './img/body/BodyMale.png');
  this.load.image('BodyFemale', './img/body/BodyFemale.png');

}

function create() {
  //UI
  this.add.sprite(400, 300, 'background');
  this.add.sprite(400, 600, 'bottomMenu');
  this.add.sprite(120, 220, 'leftMenu');
  bodyButton = this.add.sprite(120, 530, 'bodyButton').setInteractive();
  faceButton = this.add.sprite(260, 530, 'faceButton').setInteractive();
  outfitButton = this.add.sprite(400, 530, 'outfitButton').setInteractive();
  hairButton = this.add.sprite(540, 530, 'hairButton').setInteractive();
  itemButton = this.add.sprite(680, 530, 'itemButton').setInteractive();

  //Body Menu
  bodyMaleButton = this.add.sprite(60, 130, 'BodyMaleButton').setInteractive();
  bodyFemaleButton = this.add.sprite(120, 130, 'BodyFemaleButton').setInteractive();

  //Paperdoll
  body = this.add.sprite(400, 300, 'Body');
  body.visible = false;
  face = this.add.sprite(400, 300, 'Face');
  face.visible = false;
  outfit = this.add.sprite(400, 300, 'Outfit');
  outfit.visible = false;
  hair = this.add.sprite(400, 300, 'Hair');
  hair.visible = false;
  item = this.add.sprite(400, 300, 'Item');
  item.visible = false;

  //Buttons Input
  bodyButton.on('pointerdown', function(pointer, x, y) {
    if (body.visible == true) {
      body.visible = false;
    } else {
      body.visible = true;
    }
  }, this);

  faceButton.on('pointerdown', function(pointer, x, y) {
    if (face.visible == true) {
      face.visible = false;
    } else {
      face.visible = true;
    }
  }, this);

  outfitButton.on('pointerdown', function(pointer, x, y) {
    if (outfit.visible == true) {
      outfit.visible = false;
    } else {
      outfit.visible = true;
    }
  }, this);

  hairButton.on('pointerdown', function(pointer, x, y) {
    if (hair.visible == true) {
      hair.visible = false;
    } else {
      hair.visible = true;
    }
  }, this);

  itemButton.on('pointerdown', function(pointer, x, y) {
    if (item.visible == true) {
      item.visible = false;
    } else {
      item.visible = true;
    }
  }, this);

  //Body Select
  bodyMaleButton.on('pointerdown', function(pointer, x, y) {
    body.setTexture('BodyMale');
  }, this);

  bodyFemaleButton.on('pointerdown', function(pointer, x, y) {
    body.setTexture('BodyFemale');
  }, this);

  //Face Select
  //Outfit Select
  //Hair Select
  //Item Select
}


function update() {}