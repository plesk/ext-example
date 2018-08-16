import { createElement, Component, Alert, Translate, PropTypes } from '@plesk/plesk-ext-sdk';
import axios from 'axios';

export default class Overview extends Component {
    static propTypes = {
        baseUrl: PropTypes.string.isRequired,
    };

    state = {
        date: null,
    };

    componentDidMount() {
        const { baseUrl } = this.props;
        axios.get(`${baseUrl}/api/date`).then(({ data }) => this.setState({ date: data }));
    }

    render() {
        const { date } = this.state;

        if (!date) {
            return null;
        }

        return (
            <Alert intent="info">
                <Translate content="Overview.message" params={{ date }} />
            </Alert>
        );
    }
}
