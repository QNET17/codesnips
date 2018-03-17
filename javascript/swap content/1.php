<script type="text/javascript">
function swapContent(num) {
    for(i=0; obj = document.getElementById('content'+ i); ++i)
        obj.style.display = 'none';
    document.getElementById('content'+ num).style.display = 'block';
    return false;
}
</script>

<a href="#" title="xx" onclick="return swapContent(0)">0</a>
<a href="#" title="xx" onclick="return swapContent(1)">1</a>
<a href="#" title="xx" onclick="return swapContent(2)">2</a>

<div id="content0" align="center">
Eingeblendet
</div>
<div id="content1" align="center" style="display: none">
Ausgeblendet
</div>
<div id="content2" align="center" style="display: none">
Ausgeblendet
</div>