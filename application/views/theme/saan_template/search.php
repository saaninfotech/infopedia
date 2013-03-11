<!-- Search Form -->
<div class="greenBox">
    <div class="greenBoxInner searchbox">
        <h2>Enter Key Words Here For A list Of Experts In Your Category</h2>

        <form method="post" id="searchform" action="<?=__SITE_URL?>search/performSearch">
            <div class="submitBtn right"><input type="image" id="searchsubmit" value="Submit"
                                                src="<?=__TEMPLATE_URL?>images/submit-search.png"/></div>
            <input type="text" value="<?=$SearchTerm?>" name="search_text" id="search_text" class="cleardefault"/>
            <div style="font-size: 12px;">(Computer, Auto mechanic, Tax Specialist, Gardening, ETC.)</div>
        </form>
    </div>
</div>
<!-- Search Form -->
