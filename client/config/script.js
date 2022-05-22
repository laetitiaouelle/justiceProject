function printC(el){
    var restorepage=document.body.innerHTML;
    var printpage=document.getElementById(el).innerHTML;
    document.body.innerHTML=printpage;
    window.print();
    document.body.innerHTML=restorepage;
}