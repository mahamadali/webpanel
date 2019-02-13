/*Start custom script for app here */

app = {
	showNotification: function(from, align,message,icon,type){
    	$.notify({
        	icon: "fa "+icon,
        	message: message
        },{
            type: type,
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
	}
}