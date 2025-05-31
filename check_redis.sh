#!/bin/bash

# Configuration
REDIS_HOST="127.0.0.1"
REDIS_PORT="6379"

# Test connection and set/get a key
echo "Checking Redis server at $REDIS_HOST:$REDIS_PORT..."

# Check if redis-cli is available
if ! command -v redis-cli &> /dev/null
then
    echo "❌ redis-cli could not be found. Please install Redis CLI."
    exit 1
fi

# Ping Redis
PING_RESPONSE=$(redis-cli -h $REDIS_HOST -p $REDIS_PORT ping)

if [ "$PING_RESPONSE" = "PONG" ]; then
    echo "✅ Redis is up and responding to PING."

    # Set and get a key to verify read/write
    redis-cli -h $REDIS_HOST -p $REDIS_PORT set healthcheck "ok" > /dev/null
    VALUE=$(redis-cli -h $REDIS_HOST -p $REDIS_PORT get healthcheck)

    if [ "$VALUE" = "ok" ]; then
        echo "✅ Redis read/write test passed."
        exit 0
    else
        echo "❌ Redis write or read failed."
        exit 2
    fi
else
    echo "❌ Redis is not responding to PING."
    exit 1
fi

