import Cookies from 'js-cookie'
var date = new Date(new Date().getTime() + 4 * 60 * 60 * 1000);

export const getToken = (ID_TOKEN_KEY) => {
    return Cookies.get(ID_TOKEN_KEY);
    //return localStorage.getItem(ID_TOKEN_KEY);
};

export const saveToken = (ID_TOKEN_KEY, token) => {
    Cookies.set(ID_TOKEN_KEY, token, { expires: date, secure: false});
    //localStorage.setItem(ID_TOKEN_KEY, token);
};


export const destroyToken = (ID_TOKEN_KEY) => {
    Cookies.remove(ID_TOKEN_KEY);
    //localStorage.removeItem(ID_TOKEN_KEY);
};

export default { getToken, saveToken, destroyToken };
