define(function (require, exports, module) {
    
    require.async('photo', function(pw){
        pw.init( $('.user-images') );
    });

});