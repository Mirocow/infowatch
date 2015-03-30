var zmq = require('zmq');
var Sequelize = require('sequelize');

var sequelize = new Sequelize('infowatch', 'root', '884088',{
    'host' : 'localhost'
});


var Device = sequelize.define('Device', {
    id: {type: Sequelize.INTEGER, primaryKey: true },
    imei: Sequelize.STRING(45),
    imsi: Sequelize.STRING(45),
    created: Sequelize.INTEGER
},{
    timestamps: false,
    tableName: 'device'
});


var sub = zmq.socket('sub');
sub.identity = 'DeviceListener_01'; // set identity to enable durability
sub.connect('tcp://127.0.0.1:5556');
sub.subscribe('');

sub.on('message', function (data) {

    var message = JSON.parse(data.toString());

    console.log(message);

    Device.create({
        imei: message.IMEI,
        imsi: message.IMSI,
        created: message.TIME
    });
});