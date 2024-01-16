import React from 'react';

const GeocodingResults = ({results, isLoading}) => {

    if (isLoading) {
        return <p>Loading...</p>;
    }

    if (results.length <= 0) return (<div></div>);

    return (
        <div>
            <div className="geocode-results">
                <h2>Google geocoding API: </h2>
                <div className="result-container">
                    <p className="result-item">
                        <strong>Latitude:</strong> {results.google_geocoding[0]}
                    </p>
                    <p className="result-item">
                        <strong>Longitude:</strong> {results.google_geocoding[1]}
                    </p>
                </div>
            </div>

            <div className="geocode-results">
                <h2>OSM geocoding API: </h2>
                <div className="result-container">
                    <p className="result-item">
                        <strong>Latitude:</strong> {results.osm_geocoding[0]}
                    </p>
                    <p className="result-item">
                        <strong>Longitude:</strong> {results.osm_geocoding[1]}
                    </p>
                </div>
            </div>
        </div>
    );
};

export default GeocodingResults;
