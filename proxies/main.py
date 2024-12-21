import requests
from requests.exceptions import RequestException
from urllib.parse import quote
import sys

def load_proxies(filename):
    """
    Load proxies from a file. Each line should be in the format:
    IP:Port:Username:Password
    """
    proxies = []
    try:
        with open(filename, 'r') as file:
            for line in file:
                line = line.strip()
                if line and not line.startswith('#'):  # Skip empty lines and comments
                    proxies.append(line)
        return proxies
    except FileNotFoundError:
        print(f"Proxy file '{filename}' not found.")
        sys.exit(1)

def test_proxies(proxies, url):
    """
    Test each proxy by making a request to the given URL.
    If the proxy succeeds and the response is not a server error,
    output the response headers.
    """
    for proxy_str in proxies:
        try:
            ip, port, user, password = proxy_str.strip().split(':')
            proxy_url = f"http://{user}:{password}@{ip}:{port}"
            proxies_dict = {
                'http': proxy_url,
                'https': proxy_url,
            }
            print(f"Testing proxy: {proxy_url}")
            try:
                response = requests.get(url, proxies=proxies_dict, timeout=10)
                status_code = response.status_code
                if 200 <= status_code < 500:
                    print(f"Proxy {proxy_url} succeeded with status code {status_code}")
                    print("Response Headers:")
                    for header, value in response.headers.items():
                        print(f"{header}: {value}")
                else:
                    print(f"Proxy {proxy_url} returned status code {status_code}")
            except RequestException as e:
                print(f"Proxy {proxy_url} failed: {e}")
        except ValueError:
            print(f"Invalid proxy format: {proxy_str}")
        print("-" * 60)

if __name__ == "__main__":
    # File containing the list of proxies
    proxy_file = 'proxies.txt'

    # URL with proper encoding for special characters
    base_url = 'https://v6.db.transport.rest/stations?query='
    query_param = 'Düsseld'
    encoded_query = quote(query_param, safe='')
    url = f"{base_url}{encoded_query}"

    # Load proxies from the file
    proxy_list = load_proxies(proxy_file)

    # Run the test
    test_proxies(proxy_list, url)

