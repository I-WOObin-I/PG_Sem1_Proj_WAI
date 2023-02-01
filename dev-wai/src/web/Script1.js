function addToComparison(name,style,width,bindings,shape,profile,stiffness,deck,source) {
    if (typeof (Storage) !== "undefined") {
        if (sessionStorage.src1) {
            if (sessionStorage.src2) {
                var node = document.getElementById("imgPor1");
                node.remove();
                var node2 = document.getElementById("imgPor2");
                node2.remove();

                sessionStorage.src1 = sessionStorage.src2;
                sessionStorage.param1name = sessionStorage.param2name
                sessionStorage.param1style = sessionStorage.param2style
                sessionStorage.param1width = sessionStorage.param2width
                sessionStorage.param1bindings = sessionStorage.param2bindings
                sessionStorage.param1shape = sessionStorage.param2shape
                sessionStorage.param1profile = sessionStorage.param2profile
                sessionStorage.param1stiffness = sessionStorage.param2stiffness
                sessionStorage.param1deck = sessionStorage.param2deck
                var img = document.createElement("img");
                img.setAttribute("id", "imgPor1");
                img.setAttribute("alt", "deska");
                img.setAttribute("width", "100%");
                img.setAttribute("src", sessionStorage.src1)
                var node = document.getElementById("imgPor1div");
                node.appendChild(img);

                
                sessionStorage.src2 = source;
                sessionStorage.param2name = name
                sessionStorage.param2style = style
                sessionStorage.param2width = width
                sessionStorage.param2bindings = bindings
                sessionStorage.param2shape = shape
                sessionStorage.param2profile = profile
                sessionStorage.param2stiffness = stiffness
                sessionStorage.param2deck = deck
                var img = document.createElement("img");
                img.setAttribute("id", "imgPor2");
                img.setAttribute("alt", "deska");
                img.setAttribute("width", "100%");
                img.setAttribute("src", sessionStorage.src2)
                var node = document.getElementById("imgPor2div");
                node.appendChild(img);

            }
            else {
                sessionStorage.src2 = source;
                sessionStorage.param2name = name
                sessionStorage.param2style = style
                sessionStorage.param2width = width
                sessionStorage.param2bindings = bindings
                sessionStorage.param2shape = shape
                sessionStorage.param2profile = profile
                sessionStorage.param2stiffness = stiffness
                sessionStorage.param2deck = deck
                var img = document.createElement("img");
                img.setAttribute("id", "imgPor2");
                img.setAttribute("alt", "deska");
                img.setAttribute("width", "100%");
                img.setAttribute("src", sessionStorage.src2)
                var node = document.getElementById("imgPor2div");
                node.appendChild(img);
            }
        }
        else {
            sessionStorage.src1 = source;
            sessionStorage.param1name = name
            sessionStorage.param1style = style
            sessionStorage.param1width = width
            sessionStorage.param1bindings = bindings
            sessionStorage.param1shape = shape
            sessionStorage.param1profile = profile
            sessionStorage.param1stiffness = stiffness
            sessionStorage.param1deck = deck
            var img = document.createElement("img");
            img.setAttribute("id", "imgPor1");
            img.setAttribute("alt", "deska");
            img.setAttribute("width", "100%");
            img.setAttribute("src", sessionStorage.src1)
            var node = document.getElementById("imgPor1div");
            node.appendChild(img);
        }
    }
}


function initiateComparison() {
    if (sessionStorage.src1) {
        var img = document.createElement("img");
        img.setAttribute("id", "imgPor1");
        img.setAttribute("alt", "deska");
        img.setAttribute("width", "100%");
        var source = sessionStorage.src1;
        img.setAttribute("src", source)
        var node = document.getElementById("imgPor1div");
        node.appendChild(img);
    }
    if (sessionStorage.src2) {
        var img = document.createElement("img");
        img.setAttribute("id", "imgPor2");
        img.setAttribute("alt", "deska");
        img.setAttribute("width", "100%");
        var source = sessionStorage.src2;
        img.setAttribute("src", source)
        var node = document.getElementById("imgPor2div");
        node.appendChild(img);
    }
}

function sendHistory(param, source) {
    if (typeof (Storage) !== "undefined") {
        if (localStorage.param1) {
            if (localStorage.param2) {
                localStorage.param1 = localStorage.param2;
                localStorage.source1 = localStorage.source2;
                localStorage.param2 = param;
                localStorage.source2 = source;
            }
            else {
                localStorage.param2 = param;
                localStorage.source2 = source;
            }
        }
        else {
            localStorage.param1 = param;
            localStorage.source1 = source;
        }
    }
}

function showHistory() {
    if (typeof (Storage) !== "undefined") {
        if (localStorage.source1) {
            var photo = document.createElement("img")
            photo.setAttribute("src", localStorage.source1);
            photo.setAttribute("style", "float:left");
            photo.setAttribute("style", "width:150px");
            photo.setAttribute("alt", "deska");
            var node = document.getElementById("history");
            node.appendChild(photo);
        }
        if (localStorage.source2) {
            var photo = document.createElement("img")
            photo.setAttribute("src", localStorage.source2);
            photo.setAttribute("style", "float:left");
            photo.setAttribute("style", "width:150px");
            photo.setAttribute("alt", "deska");
            var node = document.getElementById("history");
            node.appendChild(photo);
        }
    }
}

$(document).ready(function () {
    $(".deski_img").mouseenter(function () {
        $(this).css("opacity", "75%");
    });
});
$(document).ready(function () {
    $(".deski_img").mouseleave(function () {
        $(this).css("opacity", "100%");
    });
});

$("#accord").accordion();


$(document).ready(function () {
    $("#logo").click(function () {
        $("#logo").effect("shake","slow");
    });
});

$(document).ready(function () {
    $(".porownajbut").click(function () {
        $(".dialogart").remove();
        $(".dialogimg").remove();
        var photo1 = document.createElement("img");
        var photo2 = document.createElement("img");

        photo1.setAttribute("class", "dialogimg");
        photo1.setAttribute("alt", "deska");
        photo1.setAttribute("src", sessionStorage.src1);
        $("#dialog").append(photo1);

        photo2.setAttribute("class", "dialogimg");
        photo2.setAttribute("alt", "deska");
        photo2.setAttribute("src", sessionStorage.src2);       
        $("#dialog").append(photo2);

        var art = document.createElement("div");
        art.setAttribute("class", "dialogart");
        var para = document.createElement("p");
        para.setAttribute("class", "dialogpara");
        var txt = document.createTextNode("");
        var text = sessionStorage.param1name + " " +
            sessionStorage.param1style + " " +
            sessionStorage.param1width + " " +
            sessionStorage.param1bindings + " " +
            sessionStorage.param1shape + " " +
            sessionStorage.param1profile + " " +
            sessionStorage.param1stiffness + " " +
            sessionStorage.param1deck;
        txt = document.createTextNode(text);
        para.appendChild(txt);
        art.appendChild(para);
        $("#dialog").append(art);
        
        var art2 = document.createElement("div");
        art2.setAttribute("class", "dialogart");
        var para2 = document.createElement("p");
        para2.setAttribute("class", "dialogpara");
        var txt2 = document.createTextNode("");
        var text2 = sessionStorage.param2name + " " +
            sessionStorage.param2style + " " +
            sessionStorage.para2width + " " +
            sessionStorage.param2bindings + " " +
            sessionStorage.param2shape + " " +
            sessionStorage.param2profile + " " +
            sessionStorage.param2stiffness + " " +
            sessionStorage.param2deck;
        txt2 = document.createTextNode(text2);
        para2.appendChild(txt2);
        art2.appendChild(para2);
        $("#dialog").append(art2);

        $("#dialog").dialog();           
    });
});

function showtabs() {
    document.getElementById("tabs").style.display = "block";
    document.getElementById("tabsalt").style.display = "none";
}
