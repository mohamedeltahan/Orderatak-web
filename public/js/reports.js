

window.onload = function () {


    var chart = new CanvasJS.Chart("heights-clients-chartContainer", {
        animationEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title: {
            text: "العملاء الاكثر شراء"
        },
        axisY: {
            title: "عدد الاوردرات",
            suffix: "",
            includeZero: false
        },
        axisX: {
            title: "العملاء"
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.0#\"%\"",
            dataPoints: [
                { label: "India", y: 7.1 },	
                { label: "China", y: 6.70 },	
                { label: "Indonesia", y: 5.00 },
                { label: "Australia", y: 2.50 },	
                { label: "Mexico", y: 2.30 },
                { label: "UK", y: 1.80 },
                { label: "United States", y: 1.60 },
                { label: "Japan", y: 1.60 }
                
            ]
        }]
    });
    chart.render();



    var chart2 = new CanvasJS.Chart("lowst-clients-chartContainer", {
        animationEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title: {
            text: "العملاء الاقل شراء"
        },
        axisY: {
            title: "عدد الاوردرات",
            suffix: "",
            includeZero: false
        },
        axisX: {
            title: "العملاء"
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.0#\"%\"",
            dataPoints: [
                { label: "India", y: 7.1 },	
                { label: "China", y: 6.70 },	
                { label: "Indonesia", y: 5.00 },
                { label: "Australia", y: 2.50 },	
                { label: "Mexico", y: 2.30 },
                { label: "UK", y: 1.80 },
                { label: "United States", y: 1.60 },
                { label: "Japan", y: 1.60 }
                
            ]
        }]
    });
    chart2.render();


    var chart3 = new CanvasJS.Chart("heighestpay-item-chartContainer", {
        animationEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title: {
            text: "المنتجات الاكثر مبيعا"
        },
        axisY: {
            title: "عدد المبيعات",
            suffix: "",
            includeZero: false
        },
        axisX: {
            title: "المنتجات"
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.0#\"%\"",
            dataPoints: [
                { label: "India", y: 7.1 },	
                { label: "China", y: 6.70 },	
                { label: "Indonesia", y: 5.00 },
                { label: "Australia", y: 2.50 },	
                { label: "Mexico", y: 2.30 },
                { label: "UK", y: 1.80 },
                { label: "United States", y: 1.60 },
                { label: "Japan", y: 1.60 }
                
            ]
        }]
    });
    chart3.render();

    var chart = new CanvasJS.Chart("heighestfounded-item-chartContainer", {
        theme: "light2",
        animationEnabled: true,
        title: {
            text: "المنتجات الاكثر توافرا"
        },
        subtitles: [{
            text: "",
            fontSize: 16
        }],
        data: [{
            type: "pie",
            indexLabelFontSize: 18,
            radius: 80,
            indexLabel: "{label} - {y}",
            yValueFormatString: "###0.0\"%\"",
            click: explodePie,
            dataPoints: [
                { y: 42, label: "Gas" },
                { y: 21, label: "Nuclear"},
                { y: 24.5, label: "Renewable" },
                { y: 9, label: "Coal" },
                { y: 3.1, label: "Other Fuels" }
            ]
        }]
    });
    chart.render();
    
    function explodePie(e) {
        for(var i = 0; i < e.dataSeries.dataPoints.length; i++) {
            if(i !== e.dataPointIndex)
                e.dataSeries.dataPoints[i].exploded = false;
        }
    }

    var chart6 = new CanvasJS.Chart("reciept-state-chartContainer", {
        animationEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title: {
            text: " حالة الفواتير "
        },
        axisY: {
            title: " عدد الفواتير ",
            suffix: "",
            includeZero: false
        },
        axisX: {
            title: "الحالات"
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.0#\"\"",
            dataPoints: [
                { label: "قيد الانتظار", y: 21 },	
                { label: "شركة الشحن", y: 17 },	
                { label: "تم التسليم", y: 125 },
                { label: "تم التأكيد", y: 27 },	
                { label: "غير متوفر", y: 13 },                
            ]
        }]
    });
    chart6.render();

    var chart7 = new CanvasJS.Chart("reciept-state-graph", {
        animationEnabled: true,  
        title:{
            text: "نسبة المرتجعات بالشهر"
        },
        axisY: {
            title: "النسبة%",
            valueFormatString: "#.",
            suffix: "",
            prefix: "%"
        },
        data: [{
            type: "splineArea",
            color: "rgba(54,158,173,.7)",
            markerSize: 5,
            xValueFormatString: "MMMM",
            yValueFormatString: "#,##0.##",
            dataPoints: [
                { x: new Date(2019, 0), y: 10 },
                { x: new Date(2019, 1), y: 27 },
                { x: new Date(2019, 2), y: 5 },
                { x: new Date(2019, 3), y: 6 },
                { x: new Date(2019, 4), y: 18 },
                { x: new Date(2019, 5), y: 67 },
                { x: new Date(2019, 6), y: 80 },
                { x: new Date(2019, 7), y: 12 },
                { x: new Date(2019, 8), y: 9 },
                { x: new Date(2019, 9), y: 97 },
                { x: new Date(2019, 10), y: 0 },
                { x: new Date(2019, 11), y:  0 },
            ]
        }]
        });
        chart7.render();
    

    //table configration
    $(document).ready( function () {
        $('#myTable').DataTable();
        var table = $('#example').DataTable();
        var table2 = $('#example2').DataTable();
        var table3 = $('#example3').DataTable();
    });
}

$(function(){
    $("#select-report").click(function(){
        var selectList = $("#select-report").val();
        $(".report").each(function(){
            if( $(this).attr("id") == selectList ){
                var width = window.widthbro;
                $(this).css({"height":"100%"});
            }else{
                $(this).css({"height":"0px" , "overflow":"hidden"});
            }
        });
    });
});