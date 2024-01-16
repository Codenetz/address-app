import React, {useState} from 'react';
import SearchBar from './../Common/SearchBar/SearchBar';
import GeocodingResults from './GeocodingResults';
import './styles/style.css';
import './styles/SearchBarStyle.css';

const Geocoding = () => {
    const [searchResults, setSearchResults] = useState([]);
    const [isLoading, setIsLoading] = useState(false);

    const onSearch = async (searchTerm) => {
        if (isLoading) return;
        if (searchTerm.trim() === '') return;

        setIsLoading(true);

        try {
            const response = await fetch(process.env.API_URL + `/get-cords?address=${searchTerm}`);
            const data = await response.json();
            setSearchResults(data);
            setIsLoading(false);
        } catch (error) {
            setIsLoading(false);
            console.error('Error fetching data:', error);
        }
    };

    return (
        <div className="geocoding-app-container">
            <div className="app-content">
                <h1>Geocoding</h1>
                <SearchBar
                    onSearch={onSearch}
                    isLoading={isLoading}
                />
                <GeocodingResults
                    results={searchResults}
                    isLoading={isLoading}
                />
            </div>
        </div>
    );
};

export default Geocoding;
