import { createElement, Component, Alert, PropTypes } from '@plesk/plesk-ext-sdk';
import axios from 'axios';

export default class Overview extends Component {
    static propTypes = {
        baseUrl: PropTypes.string.isRequired,
    };

    state = {
        data: null,
    };

    componentDidMount() {
        const { baseUrl } = this.props;
        axios.get(`${baseUrl}/api/date`).then(({ data }) => this.setState({ data }));
    }

    render() {
        const { data } = this.state;

        if (!data) {
            return null;
        }

        return (
            <Alert intent="info">
                {`Server time: ${data}`}
            </Alert>
        );
    }
}
