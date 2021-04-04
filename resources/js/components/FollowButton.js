import axios from 'axios';
import React,{useState,useEffect} from 'react';
import ReactDOM from 'react-dom';

function FollowButton(props) {

    const [follows, setFollows] = useState();

    useEffect(() => {
        if(props.follows !== ""){
            setFollows(true)

        }
        return () => {
            
        }
    }, [follows])

    const FollowUser = () => {
        console.log(props)
        axios.post('/follow/' + props.userId).then(response => {

            setFollows(!follows)

        }).catch(error => {
            if(error.response.status === 401){
                window.location = '/login';
            }

        });
        console.log(follows);
    }
    return (
        <div className="container">
            <button href="" onClick={FollowUser} className="btn btn-primary ml-4">{follows  ? "Unfollow" : "Follow"}</button>
        </div>
    );
}

export default FollowButton;

if (document.getElementById('follow-button')) {
    var data = document.getElementById('follow-button').getAttribute('userID');
    var follows = document.getElementById('follow-button').getAttribute('follows');
    ReactDOM.render(<FollowButton userId={data} follows={follows} />, document.getElementById('follow-button'));
}
