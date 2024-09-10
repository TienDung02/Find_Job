<div id="banner">
    <div class="container">
        <div class="sixteen columns">

            <div class="search-container">

                <h2>Find job</h2>

                <form action="{{ route('job.meili') }}" method="get">
                    <input type="text" class="width-90" name="query" placeholder="city, province or region" value=""/>
                    <button><i class="fa fa-search"></i></button>
                </form>

                <!-- Browse Jobs -->
                <div class="browse-jobs">
                    Browse job offers by <a href="../industry/index.blade.php"> category</a> or <a href="#">location</a>
                </div>

                <!-- Announce -->
                <div class="announce">
                    We’ve over <strong>15 000</strong> job offers for you!
                </div>

            </div>

        </div>
    </div>
</div>
