import {  createContext, useContext, useState } from "react";

const MovieContext = createContext({
    movies: [],
    setMovies: () => {}
})

export const MoviesProvider = ({children}) => {
    const [movies, setMovies] = useState([]);

    return (
        <MovieContext.Provider value = {{ movies, setMovies }} >
            {children}
        </MovieContext.Provider>
    )
};

export const useMovieContext = () => useContext(MovieContext);