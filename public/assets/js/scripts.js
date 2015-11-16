function saveImageAs(imgOrURL) {
    if (typeof imgOrURL == 'object')
        imgOrURL = imgOrURL.src;
    window.win = open (imgOrURL);
    setTimeout('win.document.execCommand("SaveAs")', 500);
}