//dodawanie klasy 'active' do odnośników w zal. od wyświetlanej strony
//http://forum.jquery.com/topic/change-active-class-when-link-is-selected-click-action

//dla menu głównego
$(function(){
    $('.nav, .navbar-nav a').filter(function(){return this.href==location.href}).parent().addClass('active').siblings().removeClass('active');
    $('.nav, .navbar-nav a').click(function(){
        $(this).parent().addClass('active').siblings().removeClass('active')	
    });
});

//dla kreatora
$(function(){
    $('.wizzardStep a').filter(function(){return this.href==location.href}).parent().addClass('active').siblings().removeClass('active');
    $('.wizzardStep a').click(function(){
        $(this).parent().addClass('active').siblings().removeClass('active')	
    });
});

//zmiana aktywości przycisków w zależności od wyboru z listy select
//http://elegantcode.com/2009/07/01/jquery-playing-with-select-dropdownlistcombobox/
$(document).ready(function() {
    $('#select').on('change', function() {
        if($(this).val() == '#') {
        $('#next').attr('disabled', 'disabled');
        //$('#modal').removeAttr('disabled');
    } else {
        $('#next').removeAttr('disabled');
        //$('#modal').attr('disabled', 'disabled');
        }
    });
});

//$_SESSION['error'] message:
$(window).load(function() {
    setTimeout(function(){ $('#error').fadeOut(2000) }, 2000);
});

//DataTables
//http://editor.datatables.net/examples/styling/bootstrap.html -> wybrać download i na lokalu grzebać w kodzie ;)
//inicjacja:
$(document).ready(function() {
    $('#example').DataTable();
});

//testowy AJAX
$(document).ready(function() {
    $('#table_test').load("engine/controller/Test2.class.php");
    $('#submit1').click(function() {
        var name = escape($('#InputName1').val());
        var profession = escape($('#InputProfession1').val());
        var url = "engine/controller/Test.class.php?name=" + name + "&profession=" + profession;
        $.get(url, function() {
            $('#table_test').load("engine/controller/Test2.class.php");
        });
    });
});