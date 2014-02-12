function genbg() {
	var height = $(document).height();
	
	for (var i = 0; i < height - 25; i = i + 25) {
		if (Math.floor(Math.random()*2) == 1) {
    		var div = $("<div style=\"position:absolute;width:25px;height:25px;background-color:rgba(0," + (Math.floor(Math.random() * (255 - 50)) + 50) + ",0,1);top:" + i + "px;animation: bounce " + (Math.floor(Math.random() * (15 - 3)) + 3) + "s linear infinite;\"><div>");
    		$("#bg").append(div);
		} else {
			var div = $("<div style=\"position:absolute;width:25px;height:25px;background-color:#000000;top:" + i + "px;\"><div>");
			$("#bg").append(div);
		}
	}
}