import React, {useState} from 'react';
import './styles/style.css';

const SearchBar = ({onSearch, isLoading}) => {
    const [searchTerm, setSearchTerm] = useState('');

    const handleInputChange = (event) => {
        setSearchTerm(event.target.value);
    };

    const handleSearch = async () => {
        onSearch(searchTerm);
    };

    const handleKeyPress = (event) => {
        if (event.key === 'Enter') handleSearch();
    };

    return (
        <div className="search-bar">
            <input
                type="text"
                placeholder="Search..."
                value={searchTerm}
                onChange={handleInputChange}
                onKeyPress={handleKeyPress}
                className="search-input"
            />
            <button disabled={isLoading} onClick={handleSearch} className="search-button">
                Search
            </button>
        </div>
    );
};

export default SearchBar;
