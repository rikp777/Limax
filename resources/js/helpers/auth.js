export function login(credentials) {
    return new Promise((resolve, reject) => {
        axios.post('/api/login', credentials)
            .then((response) => {
                resolve(response.data);
            })
            .catch((error) => {
                reject("Wrong email or password");
            })
    })
}

export function getLocalUser(){
    const userString = localStorage.getItem("user");

    if(typeof userString === "undefined"){
        return null;
    }
    return JSON.parse(userString);
}