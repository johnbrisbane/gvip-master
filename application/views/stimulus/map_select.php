<style>
.map-select__wrapper {
    width: 100%;
    height: 85vh;
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    align-items: center;
}

.map-select__container {
    width: 45%;
    height: 90%;
    background: #F2F2F4;
    border-radius: 2.5px;
    border: .5px solid #A9A9A9;
    box-shadow: 1px 1px 2px #A9A9A9;
}

.map-select__container:hover {
    transform: scale(1.025);
    transition: 300ms;
}

.image-wrapper {
    width: 100%;
    height: 70%;
    background: black;
}

.image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: .55;
}

.map-select-text {
    font-weight: lighter;
    color: #5a5a5a;
    font-size: 24px;
    text-align: center;
    margin: .5em;
}

.map-select-link {
    width: fit-content;
    margin: 3em auto;
    display: flex;
    flex-direction: row;
}

.map-select-link p {
    font-size: 24px;
    font-weight: bolder;
    color: #4C8BB4 !important;

}

.map-select-link img {
    margin-left: 5px;
    width: 25px;
    height: 25px;
}
</style>
<div class="map-select__wrapper" id="content">
    <div class="map-select__container">
        <div class="image-wrapper">
            <img src="https://d2huw5an5od7zn.cloudfront.net/select-map.png" alt="">

        </div>
        <h1 class="map-select-text">Total County Allocated Stimulus Funds</h1>
        <a class="map-select-link" href="/stimulus/countyAllocation">
            <p>View Map</p> <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/street_map.svg">
        </a>
    </div>
    <div class="map-select__container">
        <div class="image-wrapper">
            <img src="https://d2huw5an5od7zn.cloudfront.net/select-map.png" alt="">
        </div>
        <h1 class="map-select-text">County Allocated Stimulus Funds Per Capita</h1>
        <a class="map-select-link" href="/stimulus/countyAllocationPerCapita">
            <p>View Map</p> <img src="https://d2huw5an5od7zn.cloudfront.net/project_svgs/street_map.svg">
        </a>
    </div>
</div>
