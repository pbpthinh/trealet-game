const Polyline = ({ markers, map, maps }) => {
    const renderPolylines = () => {
        /** Example of rendering geodesic polyline */
        markers.map((item) => {
            item.lat = parseFloat(item.lat);
            item.lng = parseFloat(item.lng);
        });
        var iconsetngs = {
            path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
        };

        let geodesicPolyline = new maps.Polyline({
            path: markers,
            geodesic: true,
            strokeColor: "#10F61C",
            strokeOpacity: 1,
            strokeWeight: 1,
            icons: [
                {
                    repeat: "70px", //CHANGE THIS VALUE TO CHANGE THE DISTANCE BETWEEN ARROWS
                    icon: iconsetngs,
                    offset: "40%",
                },
            ],
        });
        geodesicPolyline.setMap(map);

        /** Example of rendering non geodesic polyline (straight line) */
        // let nonGeodesicPolyline = new maps.Polyline({
        //   path: markers,
        //   geodesic: false,
        //   strokeColor: '#10F61C',
        //   strokeOpacity: 0.4,
        //   strokeWeight: 1,
        //   icons: [{
        //     repeat: '500px', //CHANGE THIS VALUE TO CHANGE THE DISTANCE BETWEEN ARROWS
        //     icon: iconsetngs,
        //     offset: '100%'}]
        //   })
        // nonGeodesicPolyline.setMap(map)
    };
    return <>{renderPolylines()}</>;
};

export default Polyline;
