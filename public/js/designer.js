var config = {
  type: Phaser.AUTO,
  width: 1024,
  height: 768,
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
  //Loads all images
  var index;
  for (index = 0; index < imgLoader.length; ++index) {
    this.load.image('' + imgLoader[index] + '', './img/' + imgLoader[index] + '.png');
  }
}

function create() {

  //UI
  this.add.sprite(400, 300, 'background');
  this.add.sprite(512, 620, 'BottomMenu');

  //Menu
  var buttonGroup = this.add.group();
  bodyMenuButton = this.add.sprite(384, 35, 'BodyButton').setInteractive();
  outfitMenuButton = this.add.sprite(448, 35, 'OutfitButton').setInteractive();
  faceMenuButton = this.add.sprite(512, 35, 'FaceButton').setInteractive();
  hairMenuButton = this.add.sprite(576, 35, 'HairButton').setInteractive();
  itemMenuButton = this.add.sprite(640, 35, 'ItemButton').setInteractive();

  //Body Menu
  var bodyGroup = this.add.group();
  bodyMaleButton = bodyGroup.create(50, 530, 'BodyMale').setInteractive();
  bodyFemaleButton = bodyGroup.create(150, 530, 'BodyFemale').setInteractive();
  bodyElfButton = bodyGroup.create(250, 530, 'BodyElf').setInteractive();
  bodyMaleBlackButton = bodyGroup.create(350, 530, 'BodyMaleBlack').setInteractive();
  bodyMaleAznButton = bodyGroup.create(450, 530, 'BodyMaleAzn').setInteractive();
  bodyFemaleBlackButton = bodyGroup.create(550, 530, 'BodyFemaleBlack').setInteractive();
  bodyFemaleAznButton = bodyGroup.create(650, 530, 'BodyFemaleAzn').setInteractive();
  bodyGroup.children.iterate(function(child) {
    child.visible = false;
  });

  //Face Menu
  var faceGroup = this.add.group();
  faceNormalButton = faceGroup.create(50, 530, 'Face').setInteractive();
  faceOldButton = faceGroup.create(150, 530, 'FaceOld').setInteractive();
  faceOlderButton = faceGroup.create(250, 530, 'FaceOlder').setInteractive();
  faceAngryButton = faceGroup.create(350, 530, 'FaceAngry').setInteractive();
  faceBigEyesButton = faceGroup.create(450, 530, 'FaceBigEyes').setInteractive();
  faceEvilButton = faceGroup.create(550, 530, 'FaceEvil').setInteractive();
  faceGroup.children.iterate(function(child) {
    child.visible = false;
  });

  //Outfit Menu
  var outfitGroup = this.add.group();
  outfitArmorButton = outfitGroup.create(50, 530, 'Outfit').setInteractive();
  outfitMageButton = outfitGroup.create(150, 530, 'OutfitMage').setInteractive();
  outfitClothButton = outfitGroup.create(250, 530, 'OutfitCloth').setInteractive();
  outfitNobleButton = outfitGroup.create(350, 530, 'OutfitNoble').setInteractive();
  outfitComfyButton = outfitGroup.create(450, 530, 'OutfitComfy').setInteractive();
  outfitRogueButton = outfitGroup.create(550, 530, 'OutfitRogue').setInteractive();
  outfitGroup.children.iterate(function(child) {
    child.visible = false;
  });

  //Hair Menu
  var hairGroup = this.add.group();
  hairNormalButton = hairGroup.create(50, 530, 'Hair').setInteractive();
  hairBlondButton = hairGroup.create(150, 530, 'HairBlond').setInteractive();
  hairSilverButton = hairGroup.create(250, 530, 'HairSilver').setInteractive();
  hairBlondLongButton = hairGroup.create(350, 530, 'HairBlondLong').setInteractive();
  hairBrownButton = hairGroup.create(450, 530, 'HairBrown').setInteractive();
  hairGreyButton = hairGroup.create(550, 530, 'HairGrey').setInteractive();
  hairEdgelordButton = hairGroup.create(650, 530, 'HairEdgelord').setInteractive();
  hairGroup.children.iterate(function(child) {
    child.visible = false;
  });

  //Item Menu
  var itemGroup = this.add.group();
  itemHatButton = itemGroup.create(50, 530, 'Item').setInteractive();
  itemHornsButton = itemGroup.create(150, 530, 'ItemHorns').setInteractive();
  itemMaskButton = itemGroup.create(250, 530, 'ItemMask').setInteractive();
  itemGroup.children.iterate(function(child) {
    child.visible = false;
  });

  buttonGroup.addMultiple([bodyMaleButton, bodyFemaleButton, bodyElfButton, bodyMaleBlackButton, bodyMaleAznButton, bodyFemaleBlackButton, bodyFemaleAznButton, faceNormalButton, faceOldButton, faceOlderButton, faceAngryButton, faceBigEyesButton, faceEvilButton, outfitArmorButton, outfitMageButton, outfitClothButton, outfitNobleButton, outfitComfyButton, outfitRogueButton, hairNormalButton, hairBlondButton, hairSilverButton, hairBlondLongButton, hairBrownButton, hairGreyButton, hairEdgelordButton, itemHatButton, itemHornsButton, itemMaskButton]);

  //Paperdoll
  body = this.add.sprite(512, 300, 'Canvas');
  outfit = this.add.sprite(512, 300, 'Canvas');
  face = this.add.sprite(512, 300, 'Canvas');
  hair = this.add.sprite(512, 300, 'Canvas');
  item = this.add.sprite(512, 300, 'Canvas');

  //Input: Buttons

  //Body Menu
  bodyMenuButton.on('pointerdown', function(pointer, x, y) {
    if (bodyMaleButton.visible == false) {
      buttonGroup.children.iterate(function(child) {
        child.visible = false;
      });
      bodyGroup.children.iterate(function(child) {
        child.visible = true;
      });
    } else {
      bodyGroup.children.iterate(function(child) {
        child.visible = false;
      });
    }
  }, this);

  //Outfit Menu
  outfitMenuButton.on('pointerdown', function(pointer, x, y) {
    if (outfitArmorButton.visible == false) {
      buttonGroup.children.iterate(function(child) {
        child.visible = false;
      });
      outfitGroup.children.iterate(function(child) {
        child.visible = true;
      });
    } else {
      outfitGroup.children.iterate(function(child) {
        child.visible = false;
      });
    }
  }, this);

  //Face Menu
  faceMenuButton.on('pointerdown', function(pointer, x, y) {
    if (faceNormalButton.visible == false) {
      buttonGroup.children.iterate(function(child) {
        child.visible = false;
      });
      faceGroup.children.iterate(function(child) {
        child.visible = true;
      });
    } else {
      faceGroup.children.iterate(function(child) {
        child.visible = false;
      });
    }
  }, this);

  //Hair Menu
  hairMenuButton.on('pointerdown', function(pointer, x, y) {
    if (hairNormalButton.visible == false) {
      buttonGroup.children.iterate(function(child) {
        child.visible = false;
      });
      hairGroup.children.iterate(function(child) {
        child.visible = true;
      });
    } else {
      hairGroup.children.iterate(function(child) {
        child.visible = false;
      });
    }
  }, this);

  //Item Menu
  itemMenuButton.on('pointerdown', function(pointer, x, y) {
    if (itemHatButton.visible == false) {
      buttonGroup.children.iterate(function(child) {
        child.visible = false;
      });
      itemGroup.children.iterate(function(child) {
        child.visible = true;
      });
    } else {
      itemGroup.children.iterate(function(child) {
        child.visible = false;
      });
    }
  }, this);

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
  bodyMaleBlackButton.on('pointerdown', function(pointer, x, y) {
    body.setTexture('BodyMaleBlack');
  }, this);
  bodyMaleAznButton.on('pointerdown', function(pointer, x, y) {
    body.setTexture('BodyMaleAzn');
  }, this);
  bodyFemaleBlackButton.on('pointerdown', function(pointer, x, y) {
    body.setTexture('BodyFemaleBlack');
  }, this);
  bodyFemaleAznButton.on('pointerdown', function(pointer, x, y) {
    body.setTexture('BodyFemaleAzn');
  }, this);

  //Face Select
  faceNormalButton.on('pointerdown', function(pointer, x, y) {
    face.setTexture('Face');
  }, this);

  faceOldButton.on('pointerdown', function(pointer, x, y) {
    face.setTexture('FaceOld');
  }, this);
  faceOlderButton.on('pointerdown', function(pointer, x, y) {
    face.setTexture('FaceOlder');
  }, this);
  faceAngryButton.on('pointerdown', function(pointer, x, y) {
    face.setTexture('FaceAngry');
  }, this);
  faceBigEyesButton.on('pointerdown', function(pointer, x, y) {
    face.setTexture('FaceBigEyes');
  }, this);
  faceEvilButton.on('pointerdown', function(pointer, x, y) {
    face.setTexture('FaceEvil');
  }, this);

  //Outfit Select
  outfitArmorButton.on('pointerdown', function(pointer, x, y) {
    outfit.setTexture('Outfit');
  }, this);

  outfitMageButton.on('pointerdown', function(pointer, x, y) {
    outfit.setTexture('OutfitMage');
  }, this);
  outfitClothButton.on('pointerdown', function(pointer, x, y) {
    outfit.setTexture('OutfitCloth');
  }, this);
  outfitNobleButton.on('pointerdown', function(pointer, x, y) {
    outfit.setTexture('OutfitNoble');
  }, this);
  outfitComfyButton.on('pointerdown', function(pointer, x, y) {
    outfit.setTexture('OutfitComfy');
  }, this);
  outfitRogueButton.on('pointerdown', function(pointer, x, y) {
    outfit.setTexture('OutfitRogue');
  }, this);

  //Hair Select
  hairNormalButton.on('pointerdown', function(pointer, x, y) {
    hair.setTexture('Hair');
  }, this);
  hairBlondButton.on('pointerdown', function(pointer, x, y) {
    hair.setTexture('HairBlond');
  }, this);
  hairSilverButton.on('pointerdown', function(pointer, x, y) {
    hair.setTexture('HairSilver');
  }, this);
  hairBlondLongButton.on('pointerdown', function(pointer, x, y) {
    hair.setTexture('HairBlondLong');
  }, this);
  hairBrownButton.on('pointerdown', function(pointer, x, y) {
    hair.setTexture('HairBrown');
  }, this);
  hairGreyButton.on('pointerdown', function(pointer, x, y) {
    hair.setTexture('HairGrey');
  }, this);
  hairEdgelordButton.on('pointerdown', function(pointer, x, y) {
    hair.setTexture('HairEdgelord');
  }, this);

  //Item Select
  itemHatButton.on('pointerdown', function(pointer, x, y) {
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