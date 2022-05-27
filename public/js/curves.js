window.onload = function () {

    var username = [];
    var uservalues = [];
    var counter = 0;
    $("#statstics-hidden-info .user").each(function(){
        username[counter] = $(this).find(".name").text();
        uservalues[counter] = parseInt($(this).find(".amount").text() , 10);
        counter = counter + 1;
    });

	for(counter ; counter<5 ; counter++){
		uservalues[counter] = 0;
		username[counter] = "0";
	}

	var sales = [];
	var counter2 = 0;
	$("#hidden-sales-graph .month").each(function(){
	sales[counter2] = parseInt($(this).find(".sales").text() , 10);
	counter2 = counter2 + 1 ;
	});


	for(counter2 ; counter2<12 ; counter2++){
	sales[counter2] = 0;
	}
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title: {
		text: "المستخدمين الاكثر مبيعا"
	},
	axisY: {
		title: "عدد الاوردرات يوميا",
		includeZero: true
	},
	axisX: {
		title: "المستخدمين"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0#",
		dataPoints: [
			{ label: username[0] , y: uservalues[0] },	
			{ label: username[1] , y: uservalues[1] },
			{ label: username[2] , y: uservalues[2] },
			{ label: username[3] , y: uservalues[3] },
			{ label: username[4] , y: uservalues[4] },	
		]
	}]
});
chart.render();   




//company sales graph
var chart = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,  
	title:{
		text: "مبيعات الشركة شهريا"
	},
	axisY: {
		title: "ممثلة بالجنية المصري",
		valueFormatString: "#.",
		suffix: "جنية",
		prefix: ""
	},
	data: [{
		type: "splineArea",
		color: "rgba(54,158,173,.7)",
		markerSize: 10,
		xValueFormatString: "MMMM",
		yValueFormatString: "#,##0.##",
		dataPoints: [
			{ x: new Date(2019, 0), y: sales[0] },
			{ x: new Date(2019, 1), y: sales[1] },
			{ x: new Date(2019, 2), y: sales[2] },
			{ x: new Date(2019, 3), y: sales[3] },
			{ x: new Date(2019, 4), y: sales[4] },
			{ x: new Date(2019, 5), y: sales[5] },
			{ x: new Date(2019, 6), y: sales[6] },
			{ x: new Date(2019, 7), y: sales[7] },
			{ x: new Date(2019, 8), y: sales[8] },
			{ x: new Date(2019, 9), y: sales[9] },
			{ x: new Date(2019, 10), y: sales[10] },
			{ x: new Date(2019, 11), y:  sales[11] },
		]
	}]
	});
chart.render();

}